function ntp()
	local temp = http_get("listntp",true)
	if type(temp) == "table" then
		for k,v in pairs(temp) do
			global_ntp[k] = tonumber(temp[k])
		end
	end
	global_ntp["sync"] = global_local_config["resync_time"]
	while true do
		sleep(global_local_config["delay_seconde"])
		global_ntp["seconde"] = global_ntp["seconde"] + global_local_config["delay_seconde"]
		if global_ntp["seconde"] >= 60 then
			global_ntp["seconde"] = global_ntp["seconde"] - 60
			global_ntp["minute"] = global_ntp["minute"] + 1
			if global_ntp["minute"] >= 60 then
				global_ntp["minute"] = 0
				global_ntp["heure"] = global_ntp["heure"] + 1
				global_ntp["sync"] = global_ntp["sync"] - 1
				if global_ntp["heure"] > 23 then
					global_ntp["heure"] = 0
					global_ntp["jour"] = global_ntp["jour"] + 1
				end
				if global_ntp["sync"] <= 0 then
					local temp = http_get("listntp",true)
					if type(temp) == "table" then
						global_ntp = temp
					end
					global_ntp["sync"] = global_local_config["resync_time"]
				end
			end
		end
	end
end