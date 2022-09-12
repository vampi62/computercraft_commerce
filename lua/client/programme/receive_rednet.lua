function receive_rednet()
	while true do
		local id, message = rednet.receive()
		if type(message) == "table" then
			if message["return"] then
				rednet.send(id,"recu")
			end
		end
		global_rednet_message = message
		global_rednet_id = id
		sleep(0.2)
	end
end