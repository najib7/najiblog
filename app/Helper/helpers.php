<?php 

// bootsrap validation classe
function validation_class($error) {
	return $error ? 'is-invalid' : '';
}


// profiles images path
function blog_profile_image($image) {
	return $image ? url('storage/profiles/' . $image)  : url('storage/profiles/default.png');
}

// profiles images path
function profiles_storage_path($image) {
	return storage_path('app/public/profiles/' . $image);
}

// comment user bage
function comment_user_badge($author, $user) {
	if($user->hasRole('admin')) {
		return 'admin';
	} elseif($author->id === $user->id) {
		return 'author';
	}
	return '';
}