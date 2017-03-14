

<table border = 1>
    <tr>
        <td>nama_survei</td>
        <td>tahun</td>
        <td>bulan</td>
        <td>target</td>
        <td>realisasi</td>
        <td>dateline</td>
        <td>selengkapnya</td>
    </tr>


    <?php
    foreach ($survei as $x) {
        echo "<tr>";
        echo "<td>$x->nama_survei</td>";
        echo "<td>$x->tahun</td>";
        echo "<td>$x->bulan</td>";
        echo "<td>$x->target</td>";
        echo "<td>$x->realisasi</td>";
        echo "<td>$x->dateline</td>";
        echo "<td><a href='" . url("/laporan/harian/detil?id=" . $x->id . "&survei=" . $x->nama_survei . "&survei_id=" . $x->survei_id) . "'>detail</a></td>";
        echo "</tr>";
    }
    ?>
</table>

<?php

