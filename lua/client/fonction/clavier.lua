function clavier()
	global_key = ""
	while true do
        local event, key, maint = os.pullEvent("key")
		global_key = keys.getName(key)
    end
end