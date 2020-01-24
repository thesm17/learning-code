const accountSSID = inputData.accountID;
const accountManager = inputData.accountManager;
const companyID = inputData.companyID;

const accountID = 'ECCBC87E4B5CE2FE28308FD9F2A7BAF3';
const secretKey = 'FAE8649B15526F4349498C51D8552452';

const ssURL = `https://api.sharpspring.com/pubapi/v1.2/?accountID=${accountID}&secretKey=${secretKey}`;

const updateAccountData = {
       method: 'updateAccounts',
       params: {
           objects: [
               {
                   id: accountSSID,
                   account_manager_5c9532c817688: accountManager,
                   companyid_5b749a13907fc: companyID
               }
           ]
       },
       id: Math.floor((Math.random() * 112233445) + 1)
   }

const go = () => {
  var rawHTML;
  fetch(ssURL, {
    method: 'post',
    body:    JSON.stringify(updateAccountData),
    headers: { 'Content-Type': 'application/json' },
 })
 .then(res => res.json())
 .then(body => {
  callback(null, {rawHTML: body});
 })
 .catch(err => console.log(err));
}

go();