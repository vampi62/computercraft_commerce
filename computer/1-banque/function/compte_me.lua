function compte_me(ae)
	local melist = ae.getAvailableItems()
	local itemName = {}
	local size = {}
	local item = {}
	local nbr_piece = {0,0,0,0,0}
	for a = 1, #melist do
		local itemName[a] = melist[a].fingerprint.id
		local size[a] = melist[a].size
		for aa = 1, #piece do
			if piece[aa] == itemName[a] then
				local nbr_piece[aa] = size[a]
				local item[aa] = melist[a].fingerprint
			end
		end
	end
    return {nbr_piece[1] + nbr_piece[2] + nbr_piece[3] + nbr_piece[4] + nbr_piece[5]}
end