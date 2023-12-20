export const endpoint = 'http://localhost:8000/api';
export const connectionData = async ( endpoint , direction , method , body = false ) => {
        try {
            const requestOptions = {
                method: method,
            };
            if(body){
                requestOptions.headers = {
                    'Content-Type': 'application/json',
                };
                requestOptions.body = JSON.stringify(body);
            }
            const response = await fetch(endpoint+'/'+direction,requestOptions);
            return response.json(); 

        } catch (error) {
            console.error('Ha ocurrido un error con la API',error);
        }
}