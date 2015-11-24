<?php
    namespace CadpazBundle\DataFixtures\ORM;

    use Doctrine\Common\DataFixtures\FixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use CadpazBundle\Entity\Pessoa;
    use CadpazBundle\Entity\RG;
    use CadpazBundle\Entity\Titulo;
    use CadpazBundle\Entity\CTPS;
    use CadpazBundle\Entity\PIS;
    use CadpazBundle\Entity\Telefone;
    use CadpazBundle\Entity\Endereco;
    use CadpazBundle\Entity\Caso;
    use CadpazBundle\Entity\User;
    use CadpazBundle\Entity\Estado;
    use CadpazBundle\Entity\Encaminhamento;
    use CadpazBundle\Entity\Group;

    class LoadPessoaData implements FixtureInterface
    {
        /**
         * {@inheritDoc}
         */
        public function load(ObjectManager $manager)
        {
            $estados = array(
                    'AC' => 'Acre',
                    'AL' => 'Alagoas',
                    'AP' => 'Amapá',
                    'AM' => 'Amazonas',
                    'BA' => 'Bahia',
                    'CE' => 'Ceará',
                    'DF' => 'Distrito Federal',
                    'ES' => 'Espírito Santo',
                    'GO' => 'Goiás',
                    'MA' => 'Maranhão',
                    'MT' => 'Mato Grosso',
                    'MS' => 'Mato Grosso do Sul',
                    'MG' => 'Minas Gerais',
                    'PR' => 'Paraná',
                    'PB' => 'Paraíba',
                    'PA' => 'Pará',
                    'PE' => 'Pernambuco',
                    'PI' => 'Piauí',
                    'RJ' => 'Rio de Janeiro',
                    'RN' => 'Rio Grande do Norte',
                    'RS' => 'Rio Grande do Sul',
                    'RO' => 'Rondônia',
                    'RR' => 'Roraima',
                    'SC' => 'Santa Catarina',
                    'SE' => 'Sergipe',
                    'SP' => 'São Paulo',
                    'TO' => 'Tocantins'
                );
            foreach ( array_keys($estados) as $key  )
            {
                $estado = new Estado();
                $estado->setNome($estados[$key]);
                $estado->setUf($key);
                $manager->persist($estado);
            }
            
            // Cria o grupo de Administradores
            $admgroup = new Group('Administradores');
            $admgroup->setRoles(array());
            $admgroup->addRole('ROLE_ADMIN'); 
            
            // Cria o grupo de Editores
            $edtgroup = new Group('Editores');
            $edtgroup->setRoles(array());
            $edtgroup->addRole('ROLE_EDITOR'); 

            // Cria o grupo de Mediadores
            $mdagroup = new Group('Mediadores');
            $mdagroup->setRoles(array());
            $mdagroup->addRole('ROLE_MEDIATOR'); 
            
            // Cria o grupo de Visualizadores
            $vsgroup = new Group('Visualizadores');
            $vsgroup->setRoles(array());
            
            // Cria o usuário administrador e define seus dados
            $admin = new User() ;
            $admin->setEmail("dedraks@gmail.com") ;
            $admin->setUsername("carlos") ;
            $admin->setNomeCompleto("Carlos A. B. Garcia");
            $admin->setPlainPassword("cbj7514") ;
            $admin->setEnabled(true) ;
            $admin->addGroup($admgroup);
            
            $manager->persist($admgroup);
            $manager->persist($edtgroup);
            $manager->persist($mdagroup);
            $manager->persist($vsgroup);
            
            $manager->persist($admin);
            
            $manager->flush();
        }
    }
