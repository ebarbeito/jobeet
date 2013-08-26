<h1>Affiliates List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Url</th>
      <th>Email</th>
      <th>Token</th>
      <th>Is active</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($affiliates as $affiliate): ?>
    <tr>
      <td><a href="<?php echo url_for('affiliate/edit?id='.$affiliate->getId()) ?>"><?php echo $affiliate->getId() ?></a></td>
      <td><?php echo $affiliate->getUrl() ?></td>
      <td><?php echo $affiliate->getEmail() ?></td>
      <td><?php echo $affiliate->getToken() ?></td>
      <td><?php echo $affiliate->getIsActive() ?></td>
      <td><?php echo $affiliate->getCreatedAt() ?></td>
      <td><?php echo $affiliate->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('affiliate/new') ?>">New</a>
