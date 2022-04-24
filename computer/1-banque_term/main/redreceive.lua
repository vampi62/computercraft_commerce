function redreceive()
	while run_prog do
		local id , message = rednet.receive()
        if id == banque then
            if type(message) == "table" then
                active_read = 0
                for j = 1, #message do
                    if message[j][1] == "screen" then
                        if tonumber(message[j][2]) == 1 then
                            term0_mon1 = true
                        else
                            term0_mon1 = false
                        end
                    end
                    if message[j][1] == "clear" then
                        if term0_mon1 then
                            monitor.clear()
                        else
                            term.clear()
                        end
                    end
                    if message[j][1] == "cursor" then
                        if term0_mon1 then
                            monitor.setCursorPos(tonumber(message[j][2]),tonumber(message[j][3]))
                        else
                            term.setCursorPos(tonumber(message[j][2]),tonumber(message[j][3]))
                        end
                    end
                    if message[j][1] == "back" then
                        if term0_mon1 then
                            monitor.setBackgroundColor(tonumber(message[j][2]))
                        else
                            term.setBackgroundColor(tonumber(message[j][2]))
                        end
                    end
                    if message[j][1] == "write" then
                        if term0_mon1 then
                            monitor.write(message[j][2])
                        else
                            term.write(message[j][2])
                        end
                    end
                    if message[j][1] == "read" then
                        if message[j][2] == "*" then
                            active_read = 2
                        else
                            active_read = 1
                        end
                    end
                end
                rednet.send(banque,"ok")
            else
                if message == "update" then
                    run_prog = false
                    checkForUpdates(update_url,banque)
                elseif message == "ok" then
                    confirm_recep = true
                end
            end
        end
	end
end