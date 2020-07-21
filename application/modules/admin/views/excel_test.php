<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=hello.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table border="1" width="100%">

    <thead>

    <tr>

        <th>Nama</th>

        <th>Username</th>

        <th>Password</th>

    </tr>

    </thead>

    <tbody>



        <tr>

            <td>Hello</td>

            <td>Hello</td>

            <td>Hello</td>

        </tr>


    </tbody>

</table>