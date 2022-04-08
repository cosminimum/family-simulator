<?php

namespace App\Controller;

use App\Component\Http\Request;
use App\Component\Http\Response;
use App\Exception\FamilyMemberValidationException;
use App\Repository\FamilyMemberRepository;
use App\Repository\FamilyRepository;
use App\Service\Adapter\FamilyMemberAdapterService;
use App\Service\FamilyDataService;
use App\Service\Validator\FamilyMemberValidator;

class FrontController extends AbstractController
{
    private const ACTION_TYPE_REQUEST_KEY = "action_type";
    private const REMOVE_ACTION_REQUEST_VALUE = "remove";
    private const MEMBER_TYPE_REQUEST_KEY = "member_type";

    /** @var FamilyRepository */
    private $familyMemberRepository;
    /** @var FamilyRepository */
    private $familyRepository;


    public function __construct()
    {
        $this->familyMemberRepository = new FamilyMemberRepository();
        $this->familyRepository = new FamilyRepository();
    }

    public function index(Request $request): Response
    {
        if ($request->getParameters()) {
            if (self::REMOVE_ACTION_REQUEST_VALUE === $request->getParameters()[self::ACTION_TYPE_REQUEST_KEY]) {
                try {
                    $this->familyRepository->removeAll();
                } catch (\Exception $e) {
                    return (new Response())
                        ->setHttpCode(Response::HTTP_INTERNAL_SERVER_ERROR)
                        ->setMessage('Internal Error')
                        ;
                }

                return (new Response())
                    ->setHttpCode(Response::HTTP_OK)
                    ->setMessage('Success')
                    ->setData([])
                    ;
            }

            $familyMember = FamilyMemberAdapterService::arrayToEntity(
                $this->familyMemberRepository->findByName($request->getParameters()[self::MEMBER_TYPE_REQUEST_KEY])->getData()[0]
            );

            try {
                if (FamilyMemberValidator::validate($familyMember)) {
                    $this->familyRepository->saveMember($familyMember->getId());
                }
            } catch (FamilyMemberValidationException $e) {
                return (new Response())
                    ->setHttpCode(Response::HTTP_BAD_REQUEST)
                    ->setMessage($e->getMessage())
                    ;
            } catch (\Exception $e) {
                return (new Response())
                    ->setHttpCode(Response::HTTP_INTERNAL_SERVER_ERROR)
                    ->setMessage('Internal Error')
                ;
            }

            return (new Response())
                ->setHttpCode(Response::HTTP_OK)
                ->setMessage('Success')
                ->setData(FamilyDataService::calculate($this->familyRepository->findAll()))
            ;
        }

        return (new Response())
            ->setHttpCode(Response::HTTP_OK)
            ->setMessage('Success')
            ->setData(FamilyDataService::calculate($this->familyRepository->findAll()))
        ;
    }
}