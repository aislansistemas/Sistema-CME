function deletaInterno(id_kit,id_hospital,id_material,id_recebido){

	let div=document.createElement('div')
			div.className="container d-flex justify-content-center"
			div.style="border-radius:15px;background: rgba(180,180,18s0,0.2);margin:150px auto"

			let h5=document.createElement('h3')
			h5.innerHTML="Deseja realmente deletar este Item ?"
			h5.className="text-dark pl-2"

			let divrow=document.createElement('div')
			divrow.className="row"

			let form=document.createElement('form')
			form.action="Controllers/MaterialRecebidoController.php?acao=deletar_recebido_interno"
			form.method="POST"
			form.className="form-group"
			

			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id'
			inputid.value=id_kit

			let inputid_material=document.createElement('input')
			inputid_material.type='hidden'
			inputid_material.name='id_material'
			inputid_material.value=id_material

			let inputid_hospital=document.createElement('input')
			inputid_hospital.type='hidden'
			inputid_hospital.name='id_hospital'
			inputid_hospital.value=id_hospital

			let inputid_recebido=document.createElement('input')
			inputid_recebido.type='hidden'
			inputid_recebido.name='id_recebido'
			inputid_recebido.value=id_recebido
		
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-3 ml-5 mr-5 btn btn-success'
			button.innerHTML='CONFIRMAR'
			button.style="font-weight: 600;"

			let link=document.createElement('a')
			link.href='material_interno.php'
			link.className='mt-3 ml-5 mr-5 btn btn-danger'
			link.innerHTML='VOLTAR'
			link.style="font-weight: 600;"

			div.appendChild(form)
			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(inputid_material)
			form.appendChild(inputid_hospital)
			form.appendChild(inputid_recebido)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('titulo-pagina').innerHTML=""
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])

}

function deletaExterno(id_kit,id_hospital,id_recebido){

		let div=document.createElement('div')
			div.className="container d-flex justify-content-center"
			div.style="border-radius:15px;background: rgba(180,180,18s0,0.2);margin:150px auto"

			let h5=document.createElement('h3')
			h5.innerHTML="Deseja realmente deletar este Item ?"
			h5.className="text-dark pl-2"

			let divrow=document.createElement('div')
			divrow.className="row"

			let form=document.createElement('form')
			form.action="Controllers/MaterialRecebidoController.php?acao=deletar_recebido_externo"
			form.method="POST"
			form.className="form-group"
			

			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id'
			inputid.value=id_kit

			let inputid_id_recebido=document.createElement('input')
			inputid_id_recebido.type='hidden'
			inputid_id_recebido.name='id_recebido'
			inputid_id_recebido.value=id_recebido

			let inputid_hospital=document.createElement('input')
			inputid_hospital.type='hidden'
			inputid_hospital.name='id_hospital'
			inputid_hospital.value=id_hospital
		
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-3 ml-5 mr-5 btn btn-success'
			button.innerHTML='CONFIRMAR'
			button.style="font-weight: 600;"

			let link=document.createElement('a')
			link.href='material_externo.php'
			link.className='mt-3 ml-5 mr-5 btn btn-danger'
			link.innerHTML='VOLTAR'
			link.style="font-weight: 600;"

			div.appendChild(form)
			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(inputid_id_recebido)
			form.appendChild(inputid_hospital)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('titulo-pagina').innerHTML=""
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])
}
function deletaProceinterno(id_processado,id_hospital,id_kit_recebido){

	let div=document.createElement('div')
			div.className="container d-flex justify-content-center"
			div.style="border-radius:15px;background: rgba(180,180,18s0,0.2);margin:150px auto"

			let h5=document.createElement('h3')
			h5.innerHTML="Deseja realmente deletar este Item ?"
			h5.className="text-dark pl-2"

			let divrow=document.createElement('div')
			divrow.className="row"

			let form=document.createElement('form')
			form.action="Controllers/MaterialProcessadoController.php?acao=deletar_processado_interno"
			form.method="POST"
			form.className="form-group"
			
			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id_processado'
			inputid.value=id_processado

			let inputid_id_recebido=document.createElement('input')
			inputid_id_recebido.type='hidden'
			inputid_id_recebido.name='id_kit_recebido'
			inputid_id_recebido.value=id_kit_recebido

			let inputid_hospital=document.createElement('input')
			inputid_hospital.type='hidden'
			inputid_hospital.name='id_hospital'
			inputid_hospital.value=id_hospital
		
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-3 ml-5 mr-5 btn btn-success'
			button.innerHTML='CONFIRMAR'
			button.style="font-weight: 600;"

			let link=document.createElement('a')
			link.href='processado_interno.php'
			link.className='mt-3 ml-5 mr-5 btn btn-danger'
			link.innerHTML='VOLTAR'
			link.style="font-weight: 600;"

			div.appendChild(form)
			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(inputid_id_recebido)
			form.appendChild(inputid_hospital)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('titulo-pagina').innerHTML=""
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])
}
function deletaProceExterno(id_processado,id_hospital,id_kit_recebido){

	let div=document.createElement('div')
			div.className="container d-flex justify-content-center"
			div.style="border-radius:15px;background: rgba(180,180,18s0,0.2);margin:150px auto"

			let h5=document.createElement('h3')
			h5.innerHTML="Deseja realmente deletar este Item ?"
			h5.className="text-dark pl-2"

			let divrow=document.createElement('div')
			divrow.className="row"

			let form=document.createElement('form')
			form.action="Controllers/MaterialProcessadoController.php?acao=deletar_processado_externo"
			form.method="POST"
			form.className="form-group"
			
			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id_processado'
			inputid.value=id_processado

			let inputid_id_recebido=document.createElement('input')
			inputid_id_recebido.type='hidden'
			inputid_id_recebido.name='id_kit_recebido'
			inputid_id_recebido.value=id_kit_recebido

			let inputid_hospital=document.createElement('input')
			inputid_hospital.type='hidden'
			inputid_hospital.name='id_hospital'
			inputid_hospital.value=id_hospital
		
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-3 ml-5 mr-5 btn btn-success'
			button.innerHTML='CONFIRMAR'
			button.style="font-weight: 600;"

			let link=document.createElement('a')
			link.href='processado_externo.php'
			link.className='mt-3 ml-5 mr-5 btn btn-danger'
			link.innerHTML='VOLTAR'
			link.style="font-weight: 600;"

			div.appendChild(form)
			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(inputid_id_recebido)
			form.appendChild(inputid_hospital)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('titulo-pagina').innerHTML=""
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])
}

function deletaSaidoexterno(id_saido,id_hospital,id_kit_processado){
		let div=document.createElement('div')
			div.className="container d-flex justify-content-center"
			div.style="border-radius:15px;background: rgba(180,180,18s0,0.2);margin:150px auto"

			let h5=document.createElement('h3')
			h5.innerHTML="Deseja realmente deletar este Item ?"
			h5.className="text-dark pl-2"

			let divrow=document.createElement('div')
			divrow.className="row"

			let form=document.createElement('form')
			form.action="Controllers/SaidaMaterialController.php?acao=deletar_saido_externo"
			form.method="POST"
			form.className="form-group"
			
			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id_saido'
			inputid.value=id_saido

			let inputid_id_recebido=document.createElement('input')
			inputid_id_recebido.type='hidden'
			inputid_id_recebido.name='id_kit_processado'
			inputid_id_recebido.value=id_kit_processado

			let inputid_hospital=document.createElement('input')
			inputid_hospital.type='hidden'
			inputid_hospital.name='id_hospital'
			inputid_hospital.value=id_hospital
		
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-3 ml-5 mr-5 btn btn-success'
			button.innerHTML='CONFIRMAR'
			button.style="font-weight: 600;"

			let link=document.createElement('a')
			link.href='saido_externo.php'
			link.className='mt-3 ml-5 mr-5 btn btn-danger'
			link.innerHTML='VOLTAR'
			link.style="font-weight: 600;"

			div.appendChild(form)
			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(inputid_id_recebido)
			form.appendChild(inputid_hospital)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('titulo-pagina').innerHTML=""
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])
}

function deletaSaidointerno(id_saido,id_hospital,id_kit_processado,id_material){

			let div=document.createElement('div')
			div.className="container d-flex justify-content-center"
			div.style="border-radius:15px;background: rgba(180,180,18s0,0.2);margin:150px auto"

			let h5=document.createElement('h3')
			h5.innerHTML="Deseja realmente deletar este Item ?"
			h5.className="text-dark pl-2"

			let divrow=document.createElement('div')
			divrow.className="row"

			let form=document.createElement('form')
			form.action="Controllers/SaidaMaterialController.php?acao=deletar_saido_interno"
			form.method="POST"
			form.className="form-group"
			
			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id_saido'
			inputid.value=id_saido

			let inputid_id_recebido=document.createElement('input')
			inputid_id_recebido.type='hidden'
			inputid_id_recebido.name='id_kit_processado'
			inputid_id_recebido.value=id_kit_processado

			let inputid_hospital=document.createElement('input')
			inputid_hospital.type='hidden'
			inputid_hospital.name='id_hospital'
			inputid_hospital.value=id_hospital

			let inputid_material=document.createElement('input')
			inputid_material.type='hidden'
			inputid_material.name='id_material'
			inputid_material.value=id_material
		
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-3 ml-5 mr-5 btn btn-success'
			button.innerHTML='CONFIRMAR'
			button.style="font-weight: 600;"

			let link=document.createElement('a')
			link.href='saido_interno.php'
			link.className='mt-3 ml-5 mr-5 btn btn-danger'
			link.innerHTML='VOLTAR'
			link.style="font-weight: 600;"

			div.appendChild(form)
			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(inputid_id_recebido)
			form.appendChild(inputid_hospital)
			form.appendChild(inputid_material)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('titulo-pagina').innerHTML=""
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])
}