function pompe()
	local tempo_pompe_work = {false,false,false,false,false,false,false,false,false,true}
	local work_end = false
	if not pompe_sortie then
		turtle.select(2)
		turtle.place()
		local file = fs.open(turtle_config_pos, "w")
		file.writeLine("turtle_dir = 'center'")
		file.writeLine("mine_sortie = false")
		file.writeLine("pompe_sortie = true")
		file.writeLine("program_run = "..program_run)
		file.close()
	end
	sleep(120)
	local machine_bloc_pompe = peripheral.wrap("front")
	repeat
		sleep(10)
		for local j = 1, 10 do
			if tempo_pompe_work[j+1] ~= nil then
				tempo_pompe_work[j] = tempo_pompe_work[j+1]
			end
		end
		if machine_bloc_pompe.hasWork() == false then
			tempo_pompe_work[10] = false
			work_end = true
			for local j = 1, 10 do
				if tempo_pompe_work[j] then
					work_end = false
				end
			end
		else
			tempo_pompe_work[10] = true
		end
	until work_end
	local file = fs.open(turtle_config_pos, "w")
	file.writeLine("turtle_dir = 'center'")
	file.writeLine("mine_sortie = false")
	file.writeLine("pompe_sortie = false")
	file.writeLine("program_run = "..program_run)
	file.close()
	turtle.select(2)
	turtle.dig()
end