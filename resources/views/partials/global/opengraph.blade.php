@inject('ogService', 'App\Services\OpenGraphService')

	<meta property="og:url"                content="{{ $ogService::getUrl() }}" />
	<meta property="og:type"               content="{{ $ogService::getType() }}" />
	<meta property="og:title"              content="{{ $ogService::getTitle() }}" />
	<meta property="og:description"        content="{{ $ogService::getDescription() }}" />
	<meta property="og:image"              content="{{ $ogService::getImage() }}" />
	<meta property="og:image:width"        content="{{ $ogService::getImageWidth() }}" />
	<meta property="og:image:height"       content="{{ $ogService::getImageHeight() }}" />
