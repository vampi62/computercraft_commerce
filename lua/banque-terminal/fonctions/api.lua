
local function sendRequest(mode,endpoint,data)
    local url = configApi.apiUrl .. endpoint
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
        return {["status_code"] = "400"}
    end
end


local function getConfig()
    local config = sendRequest("GET","config")
    if config and config["status_code"] == "200" then
        return config.data
    else
        return nil
    end
end

local function getNtp()
    local ntp = sendRequest("GET","ntp")
    print(textutils.serializeJSON(ntp))
    if ntp and ntp["status_code"] == "200" then
        return ntp.data
    else
        return nil
    end
end

local function inscription(pseudo,mdp,email)
    local data = {["pseudo"] = pseudo, ["mdp"] = mdp, ["email"] = email}
    local inscription = sendRequest("POST","inscription",data)
    if inscription and inscription["status_code"] == "200" then
        return inscription.data.id
    else
        return nil
    end
end

local function connexionUser(pseudo,mdp)
    local data = {["pseudo"] = pseudo, ["mdp"] = mdp}
    local connexion = sendRequest("GET","comptes?" .. "user=" .. pseudo .. "&mdpuser=" .. mdp) 
    --local connexion = sendRequest("POST","connexionUser",data)
    if connexion["status_code"] == 200 then
        return true
    else
        return false
    end
end

local function connexionApi(pseudo,mdp)
    local data = {["pseudo"] = pseudo, ["mdp"] = mdp}
    local connexionApi = sendRequest("POST","connexionApi",data)
    if connexionApi and connexionApi["status_code"] == "200" then
        return connexionApi.data
    else
        return nil
    end
end

local function mdpOublie(email,pseudo)
    local data = {["email"] = email, ["pseudo"] = pseudo}
    local mdpoublie = sendRequest("PUT","joueur/recupmdpbyemail",data)
    if mdpoublie and mdpoublie["status_code"] == "200" then
        return true
    else
        return false
    end
end

local function mdpOublieToken(token,pseudo)
    local data = {["token"] = token, ["pseudo"] = pseudo}
    local mdpoublietoken = sendRequest("PUT","joueur/recupmdpbyemailtoken",data)
    if mdpoublietoken and mdpoublietoken["status_code"] == "200" then
        return true
    else
        return false
    end
end

local function syncNbrJeton(apikey,mdpapikey,j1,j10,j100,j1k,j10k)
    local data = {["apikey"] = apikey, ["mdpapikey"] = mdpapikey, ["j1"] = j1, ["j10"] = j10, ["j100"] = j100, ["j1k"] = j1k, ["j10k"] = j10k}
    local syncNbrJeton = sendRequest("POST","jeton",data)
    if syncNbrJeton and syncNbrJeton["status_code"] == "200" then
        return true
    else
        return false
    end
end

local function newCompte(user,mdpuser,nom,id_type_compte)
    local data = {["user"] = user, ["mdpuser"] = mdpuser, ["nom"] = nom, ["id_type_compte"] = id_type_compte}
    local newCompte = sendRequest("POST","compte",data)
    if newCompte and newCompte["status_code"] == "200" then
        return newCompte.data.id
    else
        return nil
    end
end

local function getCompteList(user,mdpuser)
    local getCompteList = sendRequest("GET","comptes?" .. "user=" .. user .. "&mdpuser=" .. mdpuser) 
    if getCompteList and getCompteList["status_code"] == "200" then
        return getCompteList.data
    else
        return nil
    end
end

local function deleteCompte(user,mdpuser,id)
    local data = {["user"] = user, ["mdpuser"] = mdpuser}
    local deleteCompte = sendRequest("DELETE","compte/" .. id,data)
    if deleteCompte and deleteCompte["status_code"] == "200" then
        return true
    else
        return false
    end
end

local function renameCompte(user,mdpuser,id,nom)
    local data = {["user"] = user, ["mdpuser"] = mdpuser, ["nom"] = nom}
    local renameCompte = sendRequest("PUT","compte/" .. id .."/nom",data)
    if renameCompte and renameCompte["status_code"] == "200" then
        return true
    else
        return false
    end
end

local function setTransaction(user,mdpuser,userbanque,mdpbanque,id_compte_debiteur,id_compte_crediteur,montant,nom,description,id_type_transaction,id_commande)
    local data = {["user"] = user, ["mdpuser"] = mdpuser, ["userbanque"] = userbanque, ["mdpbanque"] = mdpbanque, ["id_compte_debiteur"] = id_compte_debiteur, ["id_compte_crediteur"] = id_compte_crediteur, ["montant"] = montant, ["nom"] = nom, ["description"] = description, ["id_type_transaction"] = id_type_transaction, ["id_commande"] = id_commande}
    local setTransaction = sendRequest("POST","transaction",data)
    if setTransaction and setTransaction["status_code"] == "200" then
        return true
    else
        return false
    end
end

local function getTransactionList(user,mdpuser,id_compte,filtre)
    local filtreURL = ""
    for k,v in pairs(filtre) do
        filtreURL = filtreURL .. "&" .. k .. "=" .. v
    end
    local getTransactionList = sendRequest("GET","transactions/compte/" .. id_compte .. "?" .. "user=" .. user .. "&mdpuser=" .. mdpuser .. filtreURL)
    if getTransactionList and getTransactionList["status_code"] == "200" then
        return getTransactionList.data
    else
        return nil
    end
end

local function getGroupeDispoList(user,mdpuser)
    local getGroupeDispoList = sendRequest("GET","groupes/joueur?" .. "user=" .. user .. "&mdpuser=" .. mdpuser)
    if getGroupeDispoList and getGroupeDispoList["status_code"] == "200" then
        return getGroupeDispoList.data
    else
        return nil
    end
end

local function getGroupebyCompte(user,mdpuser,id_compte)
    local getGroupebyCompte = sendRequest("GET","groupes/compte/" .. id_compte .. "?" .. "user=" .. user .. "&mdpuser=" .. mdpuser)
    if getGroupebyCompte and getGroupebyCompte["status_code"] == "200" then
        return getGroupebyCompte.data
    else
        return nil
    end
end

local function getDroitsByGroupe(user,mdpuser,id_groupe)
    local getDroitsByGroupe = sendRequest("GET","groupe/" .. id_groupe .. "/droits?" .. "user=" .. user .. "&mdpuser=" .. mdpuser)
    if getDroitsByGroupe and getDroitsByGroupe["status_code"] == "200" then
        return getDroitsByGroupe.data
    else
        return nil
    end
end

local function addGroupe(user,mdpuser,nom)
    local data = {["user"] = user, ["mdpuser"] = mdpuser, ["nom"] = nom}
    local addGroupe = sendRequest("POST","groupe",data)
    if addGroupe and addGroupe["status_code"] == "200" then
        return addGroupe.data.id
    else
        return nil
    end
end

local function addGroupeCompte(user,mdpuser,id_groupe,id_compte)
    local data = {["user"] = user, ["mdpuser"] = mdpuser}
    local addGroupeCompte = sendRequest("POST","groupe/" .. id_groupe .. "/compte/" .. id_compte,data)
    if addGroupeCompte and addGroupeCompte["status_code"] == "200" then
        return true
    else
        return false
    end
end

local function deleteGroupeCompte(user,mdpuser,id_groupe,id_compte)
    local data = {["user"] = user, ["mdpuser"] = mdpuser}
    local deleteGroupeCompte = sendRequest("DELETE","groupe/" .. id_groupe .. "/compte/" .. id_compte,data)
    if deleteGroupeCompte and deleteGroupeCompte["status_code"] == "200" then
        return true
    else
        return false
    end
end

local function addGroupeDroit(user,mdpuser,id_groupe,id_droit)
    local data = {["user"] = user, ["mdpuser"] = mdpuser}
    local addGroupeDroit = sendRequest("POST","groupe/" .. id_groupe .. "/droit/" .. id_droit,data)
    if addGroupeDroit and addGroupeDroit["status_code"] == "200" then
        return true
    else
        return false
    end
end

local function deleteGroupeDroit(user,mdpuser,id_groupe,id_droit)
    local data = {["user"] = user, ["mdpuser"] = mdpuser}
    local deleteGroupeDroit = sendRequest("DELETE","groupe/" .. id_groupe .. "/droit/" .. id_droit,data)
    if deleteGroupeDroit and deleteGroupeDroit["status_code"] == "200" then
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
    deleteGroupeDroit = deleteGroupeDroit
}

--getnewversion