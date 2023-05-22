<div class="wrapper">
	<h1 id="header">CoSoSys Assignment - Plugin for WordPress.</h1>
    <h2>Dummy Data Entries List</h2>
	<hr class="divider">
	<ol>
		<?php foreach ($data as $row) { ?>
		<li>
			<?php echo $row->content; ?>
		</li>
			<?php } ?>
	</ol>
	<hr class="divider">
</div>
