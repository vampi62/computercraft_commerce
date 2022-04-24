function program()
	while run_prog do
		if program_run then
			
			
			if turtle_type == "pompe" then
				require("program/pompe.lua")
			elseif turtle_type == "finder" then
				require("program/finder.lua")
			elseif turtle_type == "dig" then
				require("program/dig.lua")
			elseif turtle_type == "custom" then
				require("program/custom.lua")
			end



			if #position_destination == 1 then
				position_destination[1] = nil
			else
				for j = 1, #position_destination do
					if position_destination[j+1] ~= nil then
						position_destination[j] = position_destination[j+1]
						position_destination[j+1] = nil
					end
				end
			end
			files = fs.open(coordonnees, "w")
			files.write("position_destination = "..textutils.serialize(position_destination))
			files.close()
			repeat
				sender("cycle")
				sleep(5)
			until reponse_cycle
			reponse_cycle = false
			if #position_destination == 0 then
				program_run = false
				local file = fs.open(turtle_config_pos, "w")
				file.writeLine("turtle_dir = "..turtle_dir)
				file.writeLine("mine_sortie = "..mine_sortie)
				file.writeLine("pompe_sortie = "..pompe_sortie)
				file.writeLine("program_run = "..program_run)
				file.close()
				repeat
					sender("terminer")
					sleep(5)
				until reponse_cycle
			end
			reponse_cycle = false
		else
			sleep(10)
		end
	end
end