function readbox()
    if active_read == 1 then
        text = read()
    else
        text = read("*")
    end
	repeat
        rednet.send(banque,text)
        sleep(0.5)
    until confirm_recep
    confirm_recep = false
    active_read = 0
end
function eject()
	while active_read > 0 do
		sleep(0.8)
	end
end

function readtemp()
	while run_prog do
		if active_read then
			parallel.waitForAny(readbox, eject)
		end
		sleep(0.8)
	end
end