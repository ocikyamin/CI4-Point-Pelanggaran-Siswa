<div class="table-responsive">
<table class="table table-sm table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Email</th>
            <th>Nama</th>
            <th>Status</th>
            <th>
                <i class="ti ti-cog"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($user as $s):?>
        <tr>
            <td><?=$i++?>.</td>
            <td><?=$s['email']?></td>
            <td><?=$s['user_fullname']?></td>
            <td>
                nj
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>