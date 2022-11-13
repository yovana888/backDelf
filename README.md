
## Buscador Backend 

Para el Backend se empleo el Framerwork de Laravel, teniendo como base de datos Postgresql, y esta deployado en Digital Ocean, baseUrl: https://monkfish-app-jrvrx.ondigitalocean.app/api/


## EndPoints Products

- Get All [obtiene los ultimos 5 productos](https://monkfish-app-jrvrx.ondigitalocean.app/api/products) 
- Get con Params: [ejemplo] (https://monkfish-app-jrvrx.ondigitalocean.app/api/products?sortBy=name&sortOrder=asc&paginate=5&name=cel) 

    * sortBy : name,id,slug
    * sortOrder:asc, desc
    * paginate:5,10,20
    * name: nombre del producto a buscar
    
 - Crud: url -- https://monkfish-app-jrvrx.ondigitalocean.app/api/products
    * Create Product: url (Post) Body: {"name":"prueba", "slug":"slug"}
    * Update Product: url/id (Patch) Body: {"name":"prueba edit", "slug":"slug edit"}
    * Delete Product: url/id (Delete) 
