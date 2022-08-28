function affichage_mon()
	for k ,v in pairs(global_monitor_list) do
		if v ~= nil then
			global_monitor_api[k].setTextScale(v)
		end
	end
	while true do
		for k ,v in pairs(global_monitor_list) do
			global_monitor_api[k].clear()
			for j = 1, #global_monitor_objet_select[k] do
				if global_monitor_objet_select[k][j]["back_color"] ~= "" then
					global_monitor_api[k].setBackgroundColor(global_monitor_objet_select[k][j]["back_color"])
					for h = global_monitor_objet_select[k][j]["ymin"], global_monitor_objet_select[k][j]["ymax"] do
						global_monitor_api[k].setCursorPos(global_monitor_objet_select[k][j]["xmin"],h)
						for l = global_monitor_objet_select[k][j]["xmin"], global_monitor_objet_select[k][j]["xmax"] do
							global_monitor_api[k].write(" ")
						end
					end
				end
			end
			for j = 1, #global_monitor_objet_write[k] do
				global_monitor_api[k].setBackgroundColor(global_monitor_objet_write[k][j]["back_color"])
				global_monitor_api[k].setTextColor(global_monitor_objet_write[k][j]["text_color"])
				global_monitor_api[k].setCursorPos(global_monitor_objet_write[k][j]["x"],global_monitor_objet_write[k][j]["y"])
				global_monitor_api[k].write(global_monitor_objet_write[k][j]["text"])
			end
		end
		sleep(0.3)
	end
end