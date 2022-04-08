<?php

namespace App\Controller;

use App\Component\Http\Response;

class AbstractController
{
    public function renderView(Response $response): void
    {
        //nice to render Twig / Smarty template here

        echo file_get_contents("/app/templates/index.html");

        if ($response->getHttpCode() !== Response::HTTP_OK) {
            echo "<b>" . $response->getMessage() . "</b>";
        }

        if (!empty($response->getData())) {
            echo '<h2>Family</h2>';

            echo '<ul>';

            echo '<li><b>Members:</b> ' . implode(", ", $response->getData()['members']) . "</li>";

            echo '<li><b>Total Members</b>: ' . $response->getData()['total_members'] . '</li>';
            echo '<li><b>Monthly Food Costs</b>: ' . $response->getData()['total_spendings'] . ' $ </li>';

            echo '</ul>';
        }
    }
}