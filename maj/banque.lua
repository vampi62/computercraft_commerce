-- mise a jour des turtles

if os.getComputerLabel() == "init" or os.getComputerLabel() == "" then
	fs.makeDir("main")
	fs.makeDir("init")
	fs.makeDir("function")
	fs.makeDir("program")

	local all_file = {}
	all_file[1] = "main/affichage.lua"
	all_file[2] = "main/anti_disk.lua"
	all_file[3] = "main/custom_affichage.lua"
	all_file[4] = "main/program.lua"
	all_file[5] = "main/receive.lua"
	all_file[6] = "program/custom.lua"
	all_file[7] = "program/dig.lua"
	all_file[8] = "program/finder.lua"
	all_file[9] = "program/pompe.lua"
	all_file[10] = "function/pompe.lua"
	all_file[11] = "function/dig.lua"
	all_file[12] = "function/move.lua"
	all_file[13] = "function/minage.lua"
	
	for j = 1, #all_file do
		local httpmaj = http.get(paste..all_file[j])
		if httpmaj.getResponseCode() == 200 then
			local file = fs.open(all_file[j],"w")
			file.write(httpmaj.readAll())
			file.close()
		else
			j = j - 1
		end
	end
else
	print("chargement de la configuration")
	local list = fs.list("init/")
	for j = 1, #list do
		shell.run("init/"..list[j])
	end
	sleep(2)
	--[[
	if version <= 2.0 then
		print("ajout de variables dans les fichiers de config existant")
		local file = fs.open(config_id, "w")
		file.writeLine("null = ")
		file.close()
		local file = fs.open(turtle_config_pos, "w")
		file.writeLine("null = ")
		file.writeLine("-- note la variable null n'est plus utilise")
		file.close()
		sleep(2)
		shell.run("edit " ..config_id)
		shell.run("edit " ..turtle_config_pos)
	end
	]]--
	print("mise a jour des fichiers programme")
	--[[
	if version <= 2.0 then
		local all_file = {}
		all_file[1] = "main/affichage.lua"
		all_file[2] = "main/anti_disk.lua"
		all_file[3] = "main/custom_affichage.lua"
		
		for j = 1, #all_file do
			local httpmaj = http.get(paste..all_file[j])
			if httpmaj.getResponseCode() == 200 then
				local file = fs.open(all_file[j],"w")
				file.write(httpmaj.readAll())
				file.close()
			end
		end
		
		fs.delete("notused.lua")
	end
	]]--
	sleep(2)
	print("mise a jour terminer le poste va redemarrer dans quelques secondes")
	fs.move("maj_program","maj_program_ok")
	sleep(2)
end
os.reboot()