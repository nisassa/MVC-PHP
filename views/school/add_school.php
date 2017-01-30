<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="container main-container">
     <div class="row">
		<div class="col-md-8 col-md-offset-2" > 		 
					
					
                    <?php if ($finalResult == true ): ?>
						<div class="alert alert-success"> The school was saved</div>
					
					<?php 
							endif;
					if (isset($errors) && $succes != true ): ?>
                            <?php foreach ($errors as $error): ?>
                                <div class="alert alert-danger"> - <?php echo $error; ?></div>
                            <?php endforeach; ?>
                    <?php endif; ?>
			
			<form class="form-group the-form"  method="post" action="/school/save_school">
			  <div class="form-group">
				<label for="school_name">School Name </label>
				<input type="text" class="form-control" name="school_name" id="school_name" >
			  </div>
			  
			  <button type="submit" name="btnSubmit" class="btn btn-default">Save</button>
			</form>
			
			<table class="table table-striped">
			  <h3 class="active">All Schools </h3>
				<tr>
					<td class="info">Name</td>
				</tr>
				<?php 
					$schoolL = $this->getScloolsList();	
					
					if ($schoolL): 
						foreach($schoolL as $school):	?>
					
						<tr>
							<td class="info"><a href="/school/members/<?php echo $school['id'];?>"><?php echo $school['Name'];?></a></td>
							
						</tr>
					<?php endforeach;
					endif;	?>
			</table>
			
		</div>	
	</div>	
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>