function http_get(action)
	local source_return, err = http.get("http://"..global_url..":"..global_port.."/"..global_uri.."/index.php?action="..action)
	local source_text = source_return.readAll()
	if source_text ~= "db_error" then
		if type(source_text) == "table" then
			return textutils.unserialise(source_text)
		else
			return source_text
		end
	else
		return "db_error"
	end
end