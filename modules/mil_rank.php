<?php
include_once("../config.php");

$s = new Game();
$s->updatePower($_SESSION['userid']);
$mil = $s->getRanks();
?>

<table width="100%" border="0">
    <tr>
        <td colspan="4" align="center">Military Effectiveness</td>
    </tr>
    <tr>
        <td align="left">Attack</td>
        <td align="right"><?= number_format($mil->milAtk); ?></td>
        <td align="right" valign="top">Rank:</td>
        <td align="left"><?= number_format($mil->milAtkRank); ?></td>
    </tr>
    <tr>
        <td align="left">Defense</td>
        <td align="right"><?= number_format($mil->milDef); ?></td>
        <td align="right" valign="top">Rank:</td>
        <td align="left"><?= number_format($mil->milDefRank); ?></td>
    </tr>
    <tr>
        <td align="left">Covert</td>
        <td align="right"><?= number_format($mil->milCov); ?></td>
        <td align="right" valign="top">Rank:</td>
        <td align="left"><?= number_format($mil->milCovRank); ?></td>
    </tr>
    <tr>
        <td align="left">AntiCovert</td>
        <td align="right"><?= number_format($mil->milAnti); ?></td>
        <td align="right" valign="top">Rank:</td>
        <td align="left"><?= number_format($mil->milAntiRank); ?></td>
    </tr>
    <tr>
        <td align="left">Total</td>
        <td align="right"><?= number_format($mil->mil); ?></td>
        <td align="right" valign="top">Rank:</td>
        <td align="left"><?= number_format($mil->milRank); ?></td>
    </tr>
</table><br />
