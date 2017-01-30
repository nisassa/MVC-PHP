<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="container main-container">
     <div class="row">
		<div class="col-md-8 col-md-offset-2" > 		 
					
			<table class="table table-striped">
				 
			<button type="button"  onclick="history.back();"  class="btn btn-lg btn-primary">Go back</button>

			  <h3 class="active">All Members of "<?php echo $SchoolName;?>" </h3>
				<tr>
					<td class="info">Name</td>
					<td class="info">Email</td>
				</tr>
				<?php
				
					//var_dump($schoolL);
					if ( isset($members) ): 
						foreach($members as $member):	?>
					
						<tr>
							<td class="info"><?php echo  $member['Name']; ?></td>
							<td class="info"><?php echo  $member['Email']; ?></td>
						</tr>
					<?php endforeach;
					endif;	?>
			</table>
			
		</div>	
	</div>	
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>