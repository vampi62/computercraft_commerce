page103 = basalt.createFrame()
x, y = term.getSize()

page103:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        page101:show()
    end)

page103:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"ACCES API"/2), 2)
    :setText("ACCES API")
    :setSize(#"ACCES API",1)

page103:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"url"/2), 4)
    :setText("url")
    :setSize(#"url",1)

local url = page103:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 5)
    :setSize(32,1)
    :setInputLimit(31)

page103:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"nom api"/2), 7)
    :setText("nom api")
    :setSize(#"nom api",1)

local nomApi = page103:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 8)
    :setSize(32,1)
    :setInputLimit(31)

page103:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"mdp api"/2), 10)
    :setText("mdp api")
    :setSize(#"mdp api",1)

local mdpApi = page103:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 11)
    :setSize(32,1)
    :setInputLimit(31)
    :setInputType("password")

page103:addButton()
    :setPosition(1 + (x/2) - math.floor(#"envoyer"/2), 13)
    :setText("envoyer")
    :setSize(#"envoyer",1)
    :onClick(function()
        local oldConfigApi = configApi
        configApi.apiUrl = url:getValue()
        configApi.apiKeyName = nomApi:getValue()
        configApi.apiKeyToken = mdpApi:getValue()
        if api.connexionApi(nomApi:getValue(), mdpApi:getValue()) then
            configfile = fs.open("/config/configApi.lua", "w")
            configfile.write("configApi = " .. textutils.serialize(configApi))
            configfile.close()
            page103alert = page103:addLabel()
                :setPosition(1 + (x/2) - math.floor(#"api connecte"/2), 15)
                :setText("api connecte")
                :setSize(#"api connecte",1)
        else
            configApi = oldConfigApi
            page103alert = page103:addLabel()
                :setPosition(1 + (x/2) - math.floor(#"erreur de connexion"/2), 15)
                :setText("erreur de connexion")
                :setSize(#"erreur de connexion",1)
        end
        page103aletTempo = 5
    end)

local timeLabel = page103:addLabel()
    :setPosition(51 - #os.date("%d/%m/%Y %H:%M"), 19)
    :setText(os.date("%d/%m/%Y %H:%M"))
    :setSize(#os.date("%d/%m/%Y %H:%M"),1)

page103TimeThread = page103:addThread()
page103TimeThread:start(function()
    page103aletTempo = 0
    while true do
        timeLabel:setText(os.date("%d/%m/%Y %H:%M"))
        sleep(1)
        if page103aletTempo > 0 then
            page103aletTempo = page103aletTempo - 1
            if page103aletTempo == 0 then
                page103alert:remove()
            end
        end
    end
end)