function http_get(action,api)
	if api then
		http.request("http://"..global_url..":"..global_port.."/"..global_api_uri.."/index.php?action="..action)
	else
		http.request("http://"..global_url..":"..global_port.."/"..global_lua_uri.."/"..action)
	end
	parallel.waitForAny(http_event_succes,http_event_fail)

	if local_text_http == "fail" then
		global_message = global_local_error_message[5]
		return "fail"
	elseif local_text_http == "db_error" then
		global_message = global_local_error_message[4]
		return "db_error"
	else
		return textutils.unserialise(local_text_http)
	end
end
function http_event_succes()
	local event, url, sourceText = os.pullEvent("http_success")
	local_text_http = sourceText.readAll()
	sourceText.close()
end
function http_event_fail()
	local event, url, sourceText = os.pullEvent("http_failure")
	local_text_http = "fail"
end