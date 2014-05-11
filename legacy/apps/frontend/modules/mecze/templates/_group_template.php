<h5><?php echo $group ?></h5>
<table>
    <thead>
    <tr>
        <th>lp</th>
        <th>Drużyna</th>
        <th>M</th>
        <th>Br</th>
        <th>P</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($teams as $team): ?>
        <tr class="promote">
            <td>1</td>
            <td><?php echo $team[0] ?></td>
            <td><?php echo $team[1] ?></td>
            <td><?php echo $team[2] ?>:<?php echo $team[3] ?></td>
            <td><?php echo $team[4] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>