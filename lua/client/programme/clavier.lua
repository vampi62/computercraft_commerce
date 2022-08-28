function clavier()
	while true do
		local event, key, maint = os.pullEvent("key")
		global_key = keys.getName(key)
		global_maint_key = maint
	end
end