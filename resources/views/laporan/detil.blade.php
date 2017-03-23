nip: <?php echo $nip ?> <br/>
target: <?php echo $target ?> responden <br/>
produktifitas terakhir: <?php echo $produktifitas ?> responden per hari<br/>
dateline: <?php echo $dateline ?> <br/>

<?php $waktu_total = ceil($target/$produktifitas) ?>

sehingga akan diselesaikan selama <?php echo $waktu_total ?> hari terhitung dari hari pertama <br/>

<br/>
realisasi: <?php echo $realisasi ?> responden -> update realisasi harian dengan form dibawah <br/>

{{ Form::open(array('url' => 'laporan/harian/detil/simpan')) }}
<input type="hidden" name="id_target" value="<?php echo $id ?>">
<input type="hidden" name="nip" value="<?php echo $nip ?>">
<input type="hidden" name="survei_id" value="<?php echo $survei_id ?>">

<table>
    <tr>
        <td>hari_ke</td>
        <td><input type="text" name="hari_ke"></td>
    </tr>
    <tr>
        <td>realisasi</td>
        <td><input type="text" name="realisasi"></td>
    </tr>
</table>
<input type="submit" value="kirim" name="kirim" />

{{ Form::close() }}

<table border = 1>
    <tr>
        <td>hari ke</td>
        <td>realisasi</td>
    </tr>
    
    <?php
    foreach($target_harian as $x){
        echo "<tr>";
        echo "<td>$x->hari_ke</td>";
        echo "<td>$x->realisasi</td>";
        echo "</tr>";
    }
    ?>
    
</table>


<br/>

<a href="<?php echo url('laporan/harian') ?>">kembali</a>

