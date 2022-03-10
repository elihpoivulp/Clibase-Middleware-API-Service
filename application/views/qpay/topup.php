<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pay with QPay</title>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.css">
	<link rel="stylesheet" href="<?php echo load_asset('qpay-styles.css') ?>">
</head>

<body style="background: rgb(63, 63, 63);">
	<div class="ui text container" style="margin: 8em auto">
		<div class="ui basic segment">
			<?php echo form_open(base_url('service/qpay/topup'), array('class' => 'ui form ' . ($has_error ? 'error' : '') )) ?>
			<div class="ui horizontally padded segment">
				<h2 class="ui header mb-2">
					<span class="content">
						充值申请 - Topup Request
					</span>
				</h2>
					<div class="field mb-2">
						<div class="ui left corner labeled input">
							<label for="customer_first_name" class="hidden">First Name</label>
							<input type="text" id="customer_first_name" name="customer_first_name" placeholder="First Name" autofocus value="<?php echo set_value('customer_first_name'); ?>" required minlength="2" maxlength="60">
							<div class="ui left corner label">
								<i class="asterisk icon"></i>
							</div>
						</div>
					</div>
				<div class="two fields mb-2">
					<div class="field">
						<div class="ui left corner labeled input">
							<label for="customer_mobile_number" class="hidden">Contact Number</label>
							<input type="text" id="customer_mobile_number" name="customer_mobile_number" placeholder="Contact Number" value="<?php echo set_value('customer_mobile_number'); ?>" required minlength="11" maxlength="11">
							<div class="ui left corner label">
								<i class="asterisk icon"></i>
							</div>
						</div>
					</div>
					<div class="field">
						<div class="ui left corner labeled input">
							<label for="customer_email" class="hidden">Email</label>
							<input type="email" id="customer_email" name="customer_email" placeholder="Email" value="<?php echo set_value('customer_email'); ?>" required minlength="4" maxlength="75">
							<div class="ui left corner label">
								<i class="asterisk icon"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="field mb-2">
					<div class="ui right labeled input">
						<input type="text" placeholder="Amount" name="amount" value="<?php echo set_value('amount'); ?>" required>
						<input type="hidden" name="currency" value="php" required>
						<div class="ui dropdown label" id="currency_selection">
							<div class="text" id="selected_currency">PHP</div>
							<i class="dropdown icon"></i>
							<div class="menu">
								<div class="item">PHP</div>
								<div class="item">USD</div>
							</div>
						</div>
					</div>
				</div>
				<?php if ($has_error): ?>
					<div class="ui error message">
						<div class="header">Topup failed</div>
						<p>
							<?php echo validation_errors(); ?>
						</p>
					</div>
				<?php endif; ?>
				<button type="submit" class="ui teal submit button">Submit</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
	<script src="<?php echo load_asset('script.js'); ?>"></script>
</body>

</html>
