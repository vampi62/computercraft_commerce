function redsend()
	while run_prog do
		local id , message = rednet.receive()
        for j = 1, nbr_box_dispo do
            if id == pc_id_box[j] then
                textbox[j] = message
            end
        end
	end
end