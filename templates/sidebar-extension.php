<?php

$user = get_post_meta( $post->ID, '_pronamic_extension_github_user', true );
$repo = get_post_meta( $post->ID, '_pronamic_extension_github_repo', true );

if ( ! empty( $user ) && ! empty( $repo ) ) {
	$github_url = sprintf( 'https://github.com/%s/%s', $user, $repo );

	?>
	<p>
		<?php

		printf(
			'<a href="%s">%s</a>',
			$github_url,
			__( 'GitHub Repository', 'robbery' )
		);

		?>
	</p>
	<?php

	$iframe = '<iframe src="%s" allowtransparency="true" frameborder="0" scrolling="0" width="%d" height="20"></iframe>';

	$ghbtns_url = add_query_arg( array(
		'user'  => $user,
		'repo'  => $repo,
		'type'  => 'watch',
		'count' => 'true',
	), 'http://ghbtns.com/github-btn.html' );

	printf( $iframe, $ghbtns_url, 100 );

	$ghbtns_url = add_query_arg( array(
		'user'  => $user,
		'repo'  => $repo,
		'type'  => 'fork',
		'count' => 'true',
	), 'http://ghbtns.com/github-btn.html' );

	printf( $iframe, $ghbtns_url, 102 );
}
