<?php

	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetTitle('My Title');
	$pdf->SetHeaderMargin(30);
	$pdf->SetTopMargin(10);
	$pdf->setFooterMargin(20);
	$pdf->SetAutoPageBreak(true);
	$pdf->SetAuthor('Author');
	$pdf->SetDisplayMode('real', 'default');

	$pdf->AddPage();
	ob_start();
?>
	<h1>Coordinator Model</h1>
	<?php foreach($coordinator_model as $api):?>
		<div nobr="true">
			<h3><?php echo $api['method_name']?></h3>
			<table nobr="true" border="1"  cellpadding="2">
				<tr>
					<td colspan="4">
						Description: <?php echo $api['revised_description'];?>
					</td>
				</tr>
				<?php if(count($api['revised_parameters'])):?>
					<tr>
						<td rowspan="<?php echo (sizeof($api['revised_parameters'])+1);?>" colspan="1">Parameter/s:</td>
						<td align="center">Name</td>
						<td align="center">Type</td>
						<td align="center">Description</td>
					</tr>
					<?php foreach($api['revised_parameters'] as $param):?>
						<tr>
							<td colspan="1" rowspan="1"><?php echo $param['name'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['type'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['description'];?></td>
						</tr>
					<?php endforeach;?>	
					
				<?php else:?>
					<tr>
						<td rowspan="1" colspan="2">Parameter/s:</td>
						<td rowspan="1" colspan="2">None</td>
					</tr>
				<?php endif;?>
				<?php if(count($api['revised_return'])):?>
					<tr>
						<td rowspan="2" colspan="1">Return:</td>
						<td colspan="1" align="center">Type</td>
						<td colspan="2" align="center">Description</td>
					</tr>
					<?php foreach($api['revised_return'] as $ret):?>
						<tr>
							<td rowspan="1" colspan="1"><?php echo $ret['type'];?></td>
							<td rowspan="1" colspan="2"><?php echo $ret['description'];?></td>
						</tr>
					<?php endforeach;?>
					
				<?php else:?>
					<tr>
						<td colspan="2">Return:</td>
						<td colspan="2">None</td>
					</tr>
				<?php endif;?>
			</table>
		</div>
	<?php endforeach;?>

	<br pagebreak="true"/>

	<h1>Super User Model</h1>
	<?php foreach($super_user_model as $api):?>
		<div nobr="true">
			<h3><?php echo $api['method_name']?></h3>
			<table nobr="true" border="1"  cellpadding="2">
				<tr>
					<td colspan="4">
						Description: <?php echo $api['revised_description'];?>
					</td>
				</tr>
				<?php if(count($api['revised_parameters'])):?>
					<tr>
						<td rowspan="<?php echo (sizeof($api['revised_parameters'])+1);?>" colspan="1">Parameter/s:</td>
						<td align="center">Name</td>
						<td align="center">Type</td>
						<td align="center">Description</td>
					</tr>
					<?php foreach($api['revised_parameters'] as $param):?>
						<tr>
							<td colspan="1" rowspan="1"><?php echo $param['name'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['type'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['description'];?></td>
						</tr>
					<?php endforeach;?>	
					
				<?php else:?>
					<tr>
						<td rowspan="1" colspan="2">Parameter/s:</td>
						<td rowspan="1" colspan="2">None</td>
					</tr>
				<?php endif;?>
				<?php if(count($api['revised_return'])):?>
					<tr>
						<td rowspan="2" colspan="1">Return:</td>
						<td colspan="1" align="center">Type</td>
						<td colspan="2" align="center">Description</td>
					</tr>
					<?php foreach($api['revised_return'] as $ret):?>
						<tr>
							<td rowspan="1" colspan="1"><?php echo $ret['type'];?></td>
							<td rowspan="1" colspan="2"><?php echo $ret['description'];?></td>
						</tr>
					<?php endforeach;?>
					
				<?php else:?>
					<tr>
						<td colspan="2">Return:</td>
						<td colspan="2">None</td>
					</tr>
				<?php endif;?>
			</table>
		</div>
	<?php endforeach;?>

	<br pagebreak="true"/>

	<h1>Faculty Model</h1>
	<?php foreach($faculty_model as $api):?>
		<div nobr="true">
			<h3><?php echo $api['method_name']?></h3>
			<table nobr="true" border="1"  cellpadding="2">
				<tr>
					<td colspan="4">
						Description: <?php echo $api['revised_description'];?>
					</td>
				</tr>
				<?php if(count($api['revised_parameters'])):?>
					<tr>
						<td rowspan="<?php echo (sizeof($api['revised_parameters'])+1);?>" colspan="1">Parameter/s:</td>
						<td align="center">Name</td>
						<td align="center">Type</td>
						<td align="center">Description</td>
					</tr>
					<?php foreach($api['revised_parameters'] as $param):?>
						<tr>
							<td colspan="1" rowspan="1"><?php echo $param['name'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['type'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['description'];?></td>
						</tr>
					<?php endforeach;?>	
					
				<?php else:?>
					<tr>
						<td rowspan="1" colspan="2">Parameter/s:</td>
						<td rowspan="1" colspan="2">None</td>
					</tr>
				<?php endif;?>
				<?php if(count($api['revised_return'])):?>
					<tr>
						<td rowspan="2" colspan="1">Return:</td>
						<td colspan="1" align="center">Type</td>
						<td colspan="2" align="center">Description</td>
					</tr>
					<?php foreach($api['revised_return'] as $ret):?>
						<tr>
							<td rowspan="1" colspan="1"><?php echo $ret['type'];?></td>
							<td rowspan="1" colspan="2"><?php echo $ret['description'];?></td>
						</tr>
					<?php endforeach;?>
					
				<?php else:?>
					<tr>
						<td colspan="2">Return:</td>
						<td colspan="2">None</td>
					</tr>
				<?php endif;?>
			</table>
		</div>
	<?php endforeach;?>

	<br pagebreak="true"/>

	<h1>Student Model</h1>
	<?php foreach($student_model as $api):?>
		<div nobr="true">
			<h3><?php echo $api['method_name']?></h3>
			<table nobr="true" border="1"  cellpadding="2">
				<tr>
					<td colspan="4">
						Description: <?php echo $api['revised_description'];?>
					</td>
				</tr>
				<?php if(count($api['revised_parameters'])):?>
					<tr>
						<td rowspan="<?php echo (sizeof($api['revised_parameters'])+1);?>" colspan="1">Parameter/s:</td>
						<td align="center">Name</td>
						<td align="center">Type</td>
						<td align="center">Description</td>
					</tr>
					<?php foreach($api['revised_parameters'] as $param):?>
						<tr>
							<td colspan="1" rowspan="1"><?php echo $param['name'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['type'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['description'];?></td>
						</tr>
					<?php endforeach;?>	
					
				<?php else:?>
					<tr>
						<td rowspan="1" colspan="2">Parameter/s:</td>
						<td rowspan="1" colspan="2">None</td>
					</tr>
				<?php endif;?>
				<?php if(count($api['revised_return'])):?>
					<tr>
						<td rowspan="2" colspan="1">Return:</td>
						<td colspan="1" align="center">Type</td>
						<td colspan="2" align="center">Description</td>
					</tr>
					<?php foreach($api['revised_return'] as $ret):?>
						<tr>
							<td rowspan="1" colspan="1"><?php echo $ret['type'];?></td>
							<td rowspan="1" colspan="2"><?php echo $ret['description'];?></td>
						</tr>
					<?php endforeach;?>
					
				<?php else:?>
					<tr>
						<td colspan="2">Return:</td>
						<td colspan="2">None</td>
					</tr>
				<?php endif;?>
			</table>
		</div>
	<?php endforeach;?>

	<br pagebreak="true"/>

	<h1>Login Model</h1>
	<?php foreach($login_model as $api):?>
		<div nobr="true">
			<h3><?php echo $api['method_name']?></h3>
			<table nobr="true" border="1"  cellpadding="2">
				<tr>
					<td colspan="4">
						Description: <?php echo $api['revised_description'];?>
					</td>
				</tr>
				<?php if(count($api['revised_parameters'])):?>
					<tr>
						<td rowspan="<?php echo (sizeof($api['revised_parameters'])+1);?>" colspan="1">Parameter/s:</td>
						<td align="center">Name</td>
						<td align="center">Type</td>
						<td align="center">Description</td>
					</tr>
					<?php foreach($api['revised_parameters'] as $param):?>
						<tr>
							<td colspan="1" rowspan="1"><?php echo $param['name'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['type'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['description'];?></td>
						</tr>
					<?php endforeach;?>	
					
				<?php else:?>
					<tr>
						<td rowspan="1" colspan="2">Parameter/s:</td>
						<td rowspan="1" colspan="2">None</td>
					</tr>
				<?php endif;?>
				<?php if(count($api['revised_return'])):?>
					<tr>
						<td rowspan="2" colspan="1">Return:</td>
						<td colspan="1" align="center">Type</td>
						<td colspan="2" align="center">Description</td>
					</tr>
					<?php foreach($api['revised_return'] as $ret):?>
						<tr>
							<td rowspan="1" colspan="1"><?php echo $ret['type'];?></td>
							<td rowspan="1" colspan="2"><?php echo $ret['description'];?></td>
						</tr>
					<?php endforeach;?>
					
				<?php else:?>
					<tr>
						<td colspan="2">Return:</td>
						<td colspan="2">None</td>
					</tr>
				<?php endif;?>
			</table>
		</div>
	<?php endforeach;?>

	<br pagebreak="true"/>

	<h1>Home Model</h1>
	<?php foreach($home_model as $api):?>
		<div nobr="true">
			<h3><?php echo $api['method_name']?></h3>
			<table nobr="true" border="1"  cellpadding="2">
				<tr>
					<td colspan="4">
						Description: <?php echo $api['revised_description'];?>
					</td>
				</tr>
				<?php if(count($api['revised_parameters'])):?>
					<tr>
						<td rowspan="<?php echo (sizeof($api['revised_parameters'])+1);?>" colspan="1">Parameter/s:</td>
						<td align="center">Name</td>
						<td align="center">Type</td>
						<td align="center">Description</td>
					</tr>
					<?php foreach($api['revised_parameters'] as $param):?>
						<tr>
							<td colspan="1" rowspan="1"><?php echo $param['name'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['type'];?></td>
							<td colspan="1" rowspan="1"><?php echo $param['description'];?></td>
						</tr>
					<?php endforeach;?>	
					
				<?php else:?>
					<tr>
						<td rowspan="1" colspan="2">Parameter/s:</td>
						<td rowspan="1" colspan="2">None</td>
					</tr>
				<?php endif;?>
				<?php if(count($api['revised_return'])):?>
					<tr>
						<td rowspan="2" colspan="1">Return:</td>
						<td colspan="1" align="center">Type</td>
						<td colspan="2" align="center">Description</td>
					</tr>
					<?php foreach($api['revised_return'] as $ret):?>
						<tr>
							<td rowspan="1" colspan="1"><?php echo $ret['type'];?></td>
							<td rowspan="1" colspan="2"><?php echo $ret['description'];?></td>
						</tr>
					<?php endforeach;?>
					
				<?php else:?>
					<tr>
						<td colspan="2">Return:</td>
						<td colspan="2">None</td>
					</tr>
				<?php endif;?>
			</table>
		</div>
	<?php endforeach;?>
	
<?php
    $content = ob_get_contents();
	ob_end_clean();
	$pdf->writeHTML($content, true, false, true, false, '');
	$pdf->Output('My-File-Name.pdf', 'I');
?>