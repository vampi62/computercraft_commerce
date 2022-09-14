function clavier()
	while true do
		local event, key, maint = os.pullEvent("key")
		local stringkey = keys.getName(key)
		if global_os_version == "CraftOS 1.8" and global_local_config["azerty"] then
			stringkey = convert_key_qwerty_vers_azerty(stringkey)
		end
		if stringkey == "leftShift" or stringkey == "rightShift" then
			global_clavier_maj["shift"] = true
		elseif stringkey == "capsLock" then
			if global_clavier_maj["lock"] then
				global_clavier_maj["lock"] = false
			else
				global_clavier_maj["lock"] = true
			end
		elseif stringkey == "rightAlt" then
			global_clavier_maj["altgr"] = true
		else
			global_clavier = stringkey
			global_maint_clavier = maint
		end
	end
end
function up_clavier()
	while true do
		local event, key, maint = os.pullEvent("key_up")
		local stringkey = keys.getName(key)
		if stringkey == "leftShift" or stringkey == "rightShift" then
			global_clavier_maj["shift"] = false
		elseif stringkey == "rightAlt" then
			global_clavier_maj["altgr"] = false
		end
	end
end