function receive_rednet()
	while true do
		local id, message = rednet.receive()
		if type(message) == "table" then
			if message["return"] then
				rednet.send(id,"recu")
			end
			global_rednet_message_table = message
		else
			global_rednet_message_string = message
		end
		global_rednet_message_id = id
		sleep(0.2)
	end
end