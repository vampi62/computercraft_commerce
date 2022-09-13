function recup_http_config()
	global_http_error_message = http_get("listconfig",true)
	if type(global_http_error_message) == "table" then
		global_http_enable = true
	end
	global_new_version = http_get("version",false)
end