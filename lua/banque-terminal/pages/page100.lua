page100 = basalt.createFrame()
x, y = term.getSize()

page100:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        page0:show()
    end)

page100:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"configurations"/2), 2)
    :setText("configurations")
    :setSize(#"configurations",1)

page100:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"MDP pc"/2), 4)
    :setText("MDP pc")
    :setSize(#"MDP pc",1)

local mdpPc = page100:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 5)
    :setSize(32,1)
    :setInputLimit(31)
    :setInputType("password")

page100:addButton()
    :setPosition(1 + (x/2) - math.floor(#"envoyer"/2), 7)
    :setText("envoyer")
    :setSize(#"envoyer",1)
    :onClick(function()
        if config.terminalPassword == mdpPc:getValue() then
            page101:show()
        else
            if page100alert then
                page100alert:remove()
            end
            page100alert = page100:addLabel()
                :setPosition(1 + (x/2) - math.floor(#"Mauvais mot de passe"/2), 9)
                :setText("Mauvais mot de passe")
            page100aletTempo = 5
        end
    end)


local timeLabel = page100:addLabel()
    :setPosition(51 - #os.date("%d/%m/%Y %H:%M"), 19)
    :setText(os.date("%d/%m/%Y %H:%M"))
    :setSize(#os.date("%d/%m/%Y %H:%M"),1)

page100TimeThread = page100:addThread()
page100TimeThread:start(function()
    page100aletTempo = 0
    while true do
        timeLabel:setText(os.date("%d/%m/%Y %H:%M"))
        sleep(1)
        if page100aletTempo > 0 then
            page100aletTempo = page100aletTempo - 1
            if page100aletTempo == 0 then
                page100alert:remove()
            end
        end
    end
end)