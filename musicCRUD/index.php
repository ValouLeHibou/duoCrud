<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>CRUD</title>

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </head>

    <?php require_once "config.php"?>

    <body>
    <h1>sequelmovie DB</h1>
    <?php
        $listdbtables = array_column(mysqli_fetch_all($link->query('SHOW TABLES')),0);
        $tablesLength = count($listdbtables);
        foreach ($listdbtables as $oneTable) {
            echo "<h2>" . $oneTable . "</h2>" ?>
            <table class="striped highlight">
                <thead>
                    <tr>
                        <?php
                        $sqlColumn = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $oneTable . "' ORDER BY ORDINAL_POSITION;";
                        if ($columnResult = mysqli_query($link, $sqlColumn)) {
                            while ($columnRow = mysqli_fetch_array($columnResult)) {
                                echo "<th>" . $columnRow[0] . "</th>";
                            }
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sqlData = "SELECT * FROM " . $oneTable;
                if ($dataResult = mysqli_query($link, $sqlData)) {
                    while ($dataRow = mysqli_fetch_array($dataResult)) {
                        $dbSize = count($dataRow) / 2;
                        echo "<tr>";
                        for ($i = 0; $i != $dbSize; $i++) {
                            echo "<td>" . $dataRow[$i] . "</td>";
                        }
                        echo "</tr>";
                    }
                } ?>
                </tbody>
            </table>
        <?php } ?>
    </body>

</html>
