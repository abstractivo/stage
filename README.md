# Stage

Esta libreria se encuentra en desarrollo, la idea principal es crear una capa de abstración para el front end
que permita acoplarse a cualquier cms sin mayores problemas, para poder agilizar la tarea de presentación de proyectos.


## TODO
- Documentar cada paso que se de para mantener un correcto seguimiento del proyecto.
- Crear la estructura de archivos base para el boostrap del sistema.


### Concepto de encapsulación

Cada módulo debe actuar por cuenta propia sin importar el contexto en el que es invocado, esto quiere decir que un módulo tiene que cumplir con una funcionalidad y debe poder adaptarse a cualquier entorno que se lo ejecute. Para esto se deberá definir un buen proceso consistente para la prueba de distintos contextos y asegurar que cumpla este requisito.


### Desencadenamientos

Uno de los pilares tiene que ser la cadena de eventos que se ejecutan en el runtime. Un objeto tiene la posibilidad de estar en escucha a un evento y un evento pude ser disparado, esto permite mantener la abstracción lo mas extensa posible.


#### Disculpas anticipadas

Sepan disculpar las faltas técnicas, y espero que este repositorio sirva para fines personales como de aprendizaje.


### Testing
Para testear se utilizara PHPUnit
