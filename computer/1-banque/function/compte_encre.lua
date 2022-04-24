function compte_encre(ae)
	local melist = ae_coffre.getAvailableItems()
	for a = 1, #melist do
		if item[a].fingerprint.id == "minecraft:paper" then
			papier = item[a].size
		end
		if item[a].fingerprint.id == "minecraft:dye" then
			encre = item[a].size
		end
	end
    return melist
end