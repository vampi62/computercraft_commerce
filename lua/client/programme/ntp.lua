function ntp()
	global_time = http_get_ntp()
	while true do
		sleep(60)
		global_time["min"] = global_time["min"] + 1
		if global_time["min"] >= 60 then
			global_time["min"] = 0
			global_time["hour"] = global_time["hour"] + 1
			global_time["sync"] = global_time["sync"] - 1
			global_time["hour"]
			if global_time["hour"] > 23 then
				global_time["hour"] = 0
				global_time["day"] = global_time["day"] + 1
			end
			if global_time["sync"] <= 0 then
				global_time = http_get_ntp()
			end
		end
	end
end