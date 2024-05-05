page4 = basalt.createFrame()
x, y = term.getSize()

page4:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        page1:show()
    end)

page4:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"mot de passe oublié"/2), 2)
    :setText("mot de passe oublié")
    :setSize(#"mot de passe oublié",1)

page4:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Pseudo"/2), 4)
    :setText("Pseudo")
    :setSize(#"Pseudo",1)

local pseudo = page4:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 5)
    :setSize(32,1)
    :setInputLimit(31)

page4:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Email"/2), 7)
    :setText("Email")
    :setSize(#"Email",1)

local email = page4:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 8)
    :setSize(32,1)
    :setInputLimit(31)

page4:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Code"/2), 10)
    :setText("Code")
    :setSize(#"Code",1)

local code = page4:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 11)
    :setSize(32,1)
    :setInputLimit(31)

page4:addButton()
    :setPosition(1 + (x/2) - math.floor(#"envoyer"/2), 13)
    :setText("envoyer")
    :setSize(#"envoyer",1)
    :onClick(function()
        if api.mdpOublieToken(code:getValue(), pseudo:getValue()) then
            page1:show()
        else
            if page4alert then
                page4alert:remove()
            end
            page4alert = page4:addLabel()
                :setPosition(1 + (x/2) - math.floor(#"Mauvais pseudo ou email"/2), 15)
                :setText("Mauvais pseudo ou email")
                :setSize(#"Mauvais pseudo ou email",1)
            page4aletTempo = 5
        end
    end)

local timeLabel = page4:addLabel()
    :setPosition(51 - #os.date("%d/%m/%Y %H:%M"), 19)
    :setText(os.date("%d/%m/%Y %H:%M"))
    :setSize(#os.date("%d/%m/%Y %H:%M"),1)

page4TimeThread = page4:addThread()
page4TimeThread:start(function()
    page4aletTempo = 0
    while true do
        timeLabel:setText(os.date("%d/%m/%Y %H:%M"))
        sleep(1)
        if page4aletTempo > 0 then
            page4aletTempo = page4aletTempo - 1
            if page4aletTempo == 0 then
                page4alert:remove()
            end
        end
    end
end)