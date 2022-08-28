function get_me_objet(me_controle,fingerprint_objet)
	local melist = me_controle.getAvailableItems()
	for j = 1, #melist do
		if melist[j]["fingerprint"]["id"] == fingerprint_objet then
			return melist[j]["size"]
		end
	end
	return 0
end
function get_tank_objet(tank)
	local datatank = tank.getTankInfo()
	return datatank[1]
	--[[
	capacity=000,
	contents={
		rawName="xxx",
		amount=000,
		name="xxx",
		id=000
	}
	]]--
end