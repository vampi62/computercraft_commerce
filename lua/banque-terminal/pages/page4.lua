page4 = basalt.createFrame()
x, y = term.getSize()

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
    :setValue(basalt.getVariable("pseudo"))

page4:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Email"/2), 7)
    :setText("Email")
    :setSize(#"Email",1)

local email = page4:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 8)
    :setSize(32,1)
    :setInputLimit(31)
    :setValue(basalt.getVariable("email"))

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
        local _mdpoublie = api.mdpOublieToken(code:getValue(), pseudo:getValue())
        if _mdpoublie[1] then
            pseudo:setValue("")
            email:setValue("")
            code:setValue("")
            page1:show()
        else
            if page4alert then
                page4alert:remove()
            end
            page4alert = page4:addLabel()
                :setPosition(1 + (x/2) - math.floor(#_mdpoublie[2]/2), 16)
                :setText(_mdpoublie[2])
                :setSize(#_mdpoublie[2],1)
                :setBackground(colors.black)
                :setForeground(colors.red)
            page4alertTempo = 5
        end
    end)


page4:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        pseudo:setValue("")
        email:setValue("")
        code:setValue("")
        page1:show()
    end)

local timeLabel = page4:addLabel()
    :setPosition(51 - #os.date("%d/%m/%Y %H:%M"), 19)
    :setText(os.date("%d/%m/%Y %H:%M"))
    :setSize(#os.date("%d/%m/%Y %H:%M"),1)

page4TimeThread = page4:addThread()
page4TimeThread:start(function()
    page4alertTempo = 0
    while true do
        timeLabel:setText(os.date("%d/%m/%Y %H:%M"))
        sleep(1)
        if page4alertTempo > 0 then
            page4alertTempo = page4alertTempo - 1
            if page4alertTempo == 0 then
                page4alert:remove()
            end
        end
    end
end)