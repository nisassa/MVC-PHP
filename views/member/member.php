<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="container main-container">
     <div class="row">
		<div class="col-md-8 col-md-offset-2" > 		 
			<?php if ( isset($message )): 
					foreach ($message as $current):?>
						<div class="alert alert-success"><?php echo $current;?></div>	
					<?php endforeach; ?>
			<?php endif; ?>
			<form class="form-group the-form"  method="post" action="/addmember/save">
			  <div class="form-group">
				<?php 
					if ( isset($nameError) && $nameError != false): 
						foreach ($nameError as $err): ?>
							<div class="alert alert-danger"><?php echo $err;?></div>
						<?php 
						endforeach;
					endif;
					  ?>
				<label for="member_name">Member Name </label>
				<input type="text" class="form-control" name="member_name" id="school_name" >
			  </div>
			  <div class="form-group">
				<?php 	if ( isset($emailError) && $emailError != false): ?>
					<?php	foreach ($emailError as $error): ?>
							<div class="alert alert-danger"><?php 	echo $error;?></div>
						 
						<?php	endforeach;?>
					<?php	endif; ?>		
				<label for="member_email">Member Email </label>
				<input type="text" class="form-control" name="member_email" id="school_name" >
			  </div>
			  <div class="form-group">
				<label for="school_name">Member School </label>
					<select name="school_name" class="form-control">
					 	<?php if (isset($schoolList) && $schoolList != false ): 
							foreach ($schoolList as $school): ?>
							
							   <option value="<?php echo $school['id']; ?>"> <?php echo $school['Name']; ?></option>
							<?php endforeach; ?>
						<?php endif; ?>

					</select>	
				</div>
			  
			  <button type="submit" name="saveMember" class="btn btn-default">Save</button>
			</form>
		</div>	
	</div>	
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>