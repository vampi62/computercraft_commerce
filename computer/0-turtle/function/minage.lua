function minage()
	local drop_bloc = false
	if not mine_sortie then
		turtle.select(1)
		turtle.place()
	end
	turtle.turnRight()
	local file = fs.open(turtle_config_pos, "w")
	file.writeLine("turtle_dir = 'right'")
	file.writeLine("mine_sortie = true")
	file.writeLine("pompe_sortie = false")
	file.writeLine("program_run = "..program_run)
	file.close()
	repeat
		sleep(1)
		drop_bloc = false
		for local j = 1, 16 do
			turtle.select(j)
			local machine_bloc_pompe = turtle.getItemDetail()
			if machine_bloc_pompe ~= nil then
				if machine_bloc_pompe["name"] ~= "BuildCraft|Factory:pumpBlock" and machine_bloc_pompe["name"] ~= "BuildCraft|Factory:miningWellBlock" then
					drop_bloc = true
					turtle.drop(j)
				end
			end
		end
	until not drop_bloc
	turtle.turnLeft()
	local file = fs.open(turtle_config_pos, "w")
	file.writeLine("turtle_dir = 'center'")
	file.writeLine("mine_sortie = false")
	file.writeLine("pompe_sortie = false")
	file.writeLine("program_run = "..program_run)
	file.close()
	turtle.select(1)
	turtle.dig()
end