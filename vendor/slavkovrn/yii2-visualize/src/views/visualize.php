<?php
$curve=[];
$x=[];
$y=[];
foreach ($graphic as $key => $val )
{
    $curve[]=$key;
    foreach ($val as $skey => $sval )
    {
        if (!in_array($skey,$x)) $x[]=$skey;
    }
}
?>

<div id="<?= $id ?>" class="<?= $class ?>" ></div>
<div id="graphic_table_<?= $id ?>" style="display:none">
    <table>
        <caption><?= $name ?></caption>
        <thead>
            <tr>
                <td></td>
                <?php foreach ($x as $val){ ?>
                    <th scope="col"><?= $val ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($curve as $name){ ?>
            <tr>
                <th scope="row"><?= $name ?></th>
                <?php foreach ($graphic[$name] as $gkey => $gval){ ?>
                    <?php if (in_array($gkey,$x)) : ?>
                        <td><?= $gval ?></td>
                    <?php else : ?>
                        <td>0</td>
                    <?php endif; ?>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

