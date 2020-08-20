create view view_horario as
  select `h`.`id_horario`      AS `id_horario`,
         `f`.`id_funcionario`  AS `id_funcionario`,
         `d`.`id_disciplina`   AS `id_disciplina`,
         `t`.`id_turma`        AS `id_turma`,
         `f`.`agente`          AS `agente`,
         `p`.`nome`            AS `nome`,

         `d`.`nome_disciplina` AS `nome_disciplina`,
         `d`.`sigla`           AS `sigla`,
         `t`.`turma`           AS `turma`,
         `sl`.`designacao`     AS `designacao`,
         `h`.`ano_lectivo`     AS `ano_lectivo`
  from ((((`tenancyschool_na004598`.`tbl_horario` `h` join `tenancyschool_na004598`.`tbl_disciplina` `d` on ((
    `h`.`id_disciplina` = `d`.`id_disciplina`))) join `tenancyschool_na004598`.`tbl_turma` `t` on ((`h`.`id_turma` =
                                                                                                    `t`.`id_turma`))) join `tenancyschool_na004598`.`tbl_sala` `sl` on ((
    `h`.`id_sala` = `sl`.`id_sala`))) join `tenancyschool_na004598`.`tbl_funcionario` `f` on ((`h`.`id_funcionario` =
                                                                                               `f`.`id_funcionario`))) join `tenancyschool_na004598`.`tbl_pessoa` `p` on ((
    `f`.`id_pessoa` = `p`.`id_pessoa`));

