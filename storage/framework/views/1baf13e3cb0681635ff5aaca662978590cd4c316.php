<?php $ogService = app('App\Services\OpenGraphService'); ?>

	<meta property="og:url"                content="<?php echo e($ogService::getUrl()); ?>" />
	<meta property="og:type"               content="<?php echo e($ogService::getType()); ?>" />
	<meta property="og:title"              content="<?php echo e($ogService::getTitle()); ?>" />
	<meta property="og:description"        content="<?php echo e($ogService::getDescription()); ?>" />
	<meta property="og:image"              content="<?php echo e($ogService::getImage()); ?>" />
	<meta property="og:image:width"        content="<?php echo e($ogService::getImageWidth()); ?>" />
	<meta property="og:image:height"       content="<?php echo e($ogService::getImageHeight()); ?>" />
