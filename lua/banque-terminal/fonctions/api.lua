
local function sendRequest(mode,endpoint,data)
    local url = configApi.apiUrl .. "api/" .. endpoint
    local response = nil
    if mode == "GET" then
        response = http.get(url)
    elseif mode == "POST" then
        response = http.post(url, textutils.serializeJSON(data))
    elseif mode == "PUT" then
        response = http.put(url, textutils.serializeJSON(data))
    elseif mode == "DELETE" then
        response = http.delete(url)
    end
    
    if response then
        local responseData = response.readAll()
        response.close()
        return textutils.unserializeJSON(responseData)
    else
        return {["status_code"] = "400", ["message"] = "Erreur de connexion"}
    end
end


local function getConfig()
    local config = sendRequest("GET","config")
    if config["status_code"] == 200 then
        return {true,config.message,config.data}
    else
        return {false,config.message}
    end
end

local function getNtp()
    local ntp = sendRequest("GET","ntp")
    if ntp["status_code"] == 200 then
        return {true,ntp.message,ntp.data}
    else
        return {false,ntp.message}
    end
end

local function inscription(pseudo,mdp,email)
    local data = {["pseudo"] = pseudo, ["mdp"] = mdp, ["email"] = email}
    local inscription = sendRequest("POST","inscription",data)
    if inscription["status_code"] == 200 then
        return {true,inscription.message,inscription.data.id}
    else
        return {false,inscription.message}
    end
end

local function connexionUser(user,mdpuser)
    local data = {["user"] = pseudo, ["mdpuser"] = mdp}
    local connexion = sendRequest("POST","token",data)
    if connexion["status_code"] == 200 then
        return {true,connexion.message,connexion.data.idLogin}
    else
        return {false,connexion.message}
    end
end

local function connexionApi(apikey,mdpapikey)
    local data = {["apikey"] = apikey, ["mdpapikey"] = mdpapikey}
    local connexion = sendRequest("POST","token",data)
    if connexionApi["status_code"] == 200 then
        return {true,connexionApi.message,connexion.data.idLogin}
    else
        return {false,connexionApi.message}
    end
end

local function mdpOublie(email,pseudo)
    local data = {["email"] = email, ["pseudo"] = pseudo}
    local mdpoublie = sendRequest("PUT","joueur/recupmdpbyemail",data)
    if mdpoublie["status_code"] == 200 then
        return {true,mdpoublie.message}
    else
        return {false,mdpoublie.message}
    end
end

local function mdpOublieToken(token,pseudo)
    local data = {["token"] = token, ["pseudo"] = pseudo}
    local mdpoublietoken = sendRequest("PUT","joueur/recupmdpbyemailtoken",data)
    if mdpoublietoken["status_code"] == 200 then
        return {true,mdpoublietoken.message}
    else
        return {false,mdpoublietoken.message}
    end
end

local function syncNbrJeton(apikey,mdpapikey,j1,j10,j100,j1k,j10k)
    local data = {["apikey"] = apikey, ["mdpapikey"] = mdpapikey, ["j1"] = j1, ["j10"] = j10, ["j100"] = j100, ["j1k"] = j1k, ["j10k"] = j10k}
    local syncNbrJeton = sendRequest("POST","jeton",data)
    if syncNbrJeton["status_code"] == 200 then
        return {true,syncNbrJeton.message}
    else
        return {false,syncNbrJeton.message}
    end
end

local function newCompte(user,mdpuser,nom,id_type_compte)
    local data = {["user"] = user, ["mdpuser"] = mdpuser, ["nom"] = nom, ["id_type_compte"] = id_type_compte}
    local newCompte = sendRequest("POST","compte",data)
    if newCompte["status_code"] == 200 then
        return {true,newCompte.message,newCompte.data.id}
    else
        return {false,newCompte.message}
    end
end

local function getCompteList(user,mdpuser)
    local getCompteList = sendRequest("GET","comptes?" .. "user=" .. user .. "&mdpuser=" .. mdpuser) 
    if getCompteList["status_code"] == 200 then
        return {true,getCompteList.message,getCompteList.data}
    else
        return {false,getCompteList.message}
    end
end

local function deleteCompte(user,mdpuser,id)
    local data = {["user"] = user, ["mdpuser"] = mdpuser}
    local deleteCompte = sendRequest("DELETE","compte/" .. id,data)
    if deleteCompte["status_code"] == 200 then
        return {true,deleteCompte.message}
    else
        return {false,deleteCompte.message}
    end
end

local function renameCompte(user,mdpuser,id,nom)
    local data = {["user"] = user, ["mdpuser"] = mdpuser, ["nom"] = nom}
    local renameCompte = sendRequest("PUT","compte/" .. id .."/nom",data)
    if renameCompte["status_code"] == 200 then
        return {true,renameCompte.message}
    else
        return {false,renameCompte.message}
    end
end

local function setTransaction(user,mdpuser,userbanque,mdpbanque,id_compte_debiteur,id_compte_crediteur,montant,nom,description,id_type_transaction,id_commande)
    local data = {["user"] = user, ["mdpuser"] = mdpuser, ["userbanque"] = userbanque, ["mdpbanque"] = mdpbanque, ["id_compte_debiteur"] = id_compte_debiteur, ["id_compte_crediteur"] = id_compte_crediteur, ["montant"] = montant, ["nom"] = nom, ["description"] = description, ["id_type_transaction"] = id_type_transaction, ["id_commande"] = id_commande}
    local setTransaction = sendRequest("POST","transaction",data)
    if setTransaction["status_code"] == 200 then
        return {true,setTransaction.message}
    else
        return {false,setTransaction.message}
    end
end

local function getTransactionList(user,mdpuser,id_compte,filtre)
    local filtreURL = ""
    for k,v in pairs(filtre) do
        filtreURL = filtreURL .. "&" .. k .. "=" .. v
    end
    local getTransactionList = sendRequest("GET","transactions/compte/" .. id_compte .. "?" .. "user=" .. user .. "&mdpuser=" .. mdpuser .. filtreURL)
    if getTransactionList["status_code"] == 200 then
        return {true,getTransactionList.message,getTransactionList.data}
    else
        return {false,getTransactionList.message}
    end
end

local function getGroupeDispoList(user,mdpuser)
    local getGroupeDispoList = sendRequest("GET","groupes/joueur?" .. "user=" .. user .. "&mdpuser=" .. mdpuser)
    if getGroupeDispoList["status_code"] == 200 then
        return {true,getGroupeDispoList.message,getGroupeDispoList.data}
    else
        return {false,getGroupeDispoList.message}
    end
end

local function getGroupebyCompte(user,mdpuser,id_compte)
    local getGroupebyCompte = sendRequest("GET","groupes/compte/" .. id_compte .. "?" .. "user=" .. user .. "&mdpuser=" .. mdpuser)
    if getGroupebyCompte["status_code"] == 200 then
        return {true,getGroupebyCompte.message,getGroupebyCompte.data}
    else
        return {false,getGroupebyCompte.message}
    end
end

local function getDroitsByGroupe(user,mdpuser,id_groupe)
    local getDroitsByGroupe = sendRequest("GET","groupe/" .. id_groupe .. "/droits?" .. "user=" .. user .. "&mdpuser=" .. mdpuser)
    if getDroitsByGroupe["status_code"] == 200 then
        return {true,getDroitsByGroupe.message,getDroitsByGroupe.data}
    else
        return {false,getDroitsByGroupe.message}
    end
end

local function addGroupe(user,mdpuser,nom)
    local data = {["user"] = user, ["mdpuser"] = mdpuser, ["nom"] = nom}
    local addGroupe = sendRequest("POST","groupe",data)
    if addGroupe["status_code"] == 200 then
        return {true,addGroupe.message,addGroupe.data.id}
    else
        return {false,addGroupe.message}
    end
end

local function addGroupeCompte(user,mdpuser,id_groupe,id_compte)
    local data = {["user"] = user, ["mdpuser"] = mdpuser}
    local addGroupeCompte = sendRequest("POST","groupe/" .. id_groupe .. "/compte/" .. id_compte,data)
    if addGroupeCompte["status_code"] == 200 then
        return {true,addGroupeCompte.message}
    else
        return {false,addGroupeCompte.message}
    end
end

local function deleteGroupeCompte(user,mdpuser,id_groupe,id_compte)
    local data = {["user"] = user, ["mdpuser"] = mdpuser}
    local deleteGroupeCompte = sendRequest("DELETE","groupe/" .. id_groupe .. "/compte/" .. id_compte,data)
    if deleteGroupeCompte["status_code"] == 200 then
        return {true,deleteGroupeCompte.message}
    else
        return {false,deleteGroupeCompte.message}
    end
end

local function addGroupeDroit(user,mdpuser,id_groupe,id_droit)
    local data = {["user"] = user, ["mdpuser"] = mdpuser}
    local addGroupeDroit = sendRequest("POST","groupe/" .. id_groupe .. "/droit/" .. id_droit,data)
    if addGroupeDroit["status_code"] == 200 then
        return {true,addGroupeDroit.message}
    else
        return {false,addGroupeDroit.message}
    end
end

local function deleteGroupeDroit(user,mdpuser,id_groupe,id_droit)
    local data = {["user"] = user, ["mdpuser"] = mdpuser}
    local deleteGroupeDroit = sendRequest("DELETE","groupe/" .. id_groupe .. "/droit/" .. id_droit,data)
    if deleteGroupeDroit["status_code"] == 200 then
        return {true,deleteGroupeDroit.message}
    else
        return {false,deleteGroupeDroit.message}
    end
end

local function getLuaBySysteme(name)
    local lua = sendRequest("GET","lua/systeme/?systeme=" .. name)
    if lua["status_code"] == 200 then
        return {true,lua.message,lua.data}
    else
        return {false,lua.message}
    end
end

local function download(file)
    -- supprimer le premier / si il y en a un
    --local fileURL = string.
    local _fileData = http.get(configApi.apiUrl .. "lua/" .. config.systemName .. "/" .. fileURL)
    if _fileData then
        local _localFile = fs.open(file, "w")
        _localFile.write(_fileData.readAll())
        _localFile.close()
        _fileData.close()
        return true
    else
        return false
    end
end

api = {
    getConfig = getConfig,
    getNtp = getNtp,
    inscription = inscription,
    connexionUser = connexionUser,
    connexionApi = connexionApi,
    mdpoublie = mdpoublie,
    mdpoublietoken = mdpoublietoken,
    syncNbrJeton = syncNbrJeton,
    newCompte = newCompte,
    getCompteList = getCompteList,
    deleteCompte = deleteCompte,
    renameCompte = renameCompte,
    setTransaction = setTransaction,
    getTransactionList = getTransactionList,
    getGroupeDispoList = getGroupeDispoList,
    getGroupebyCompte = getGroupebyCompte,
    getDroitsByGroupe = getDroitsByGroupe,
    addGroupe = addGroupe,
    addGroupeCompte = addGroupeCompte,
    deleteGroupeCompte = deleteGroupeCompte,
    addGroupeDroit = addGroupeDroit,
    deleteGroupeDroit = deleteGroupeDroit,
    getLuaBySysteme = getLuaBySysteme,
    download = download
}

--getnewversion