<?php

function admins()
{
	return auth()->guard(config('auth.defaults.admin_guard'));
}
