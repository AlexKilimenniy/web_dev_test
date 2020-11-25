CREATE TABLE `tags_to_cookery` (
  `id_tag` INT NOT NULL,
  `id_cookery` INT NOT NULL,
  PRIMARY KEY (`id_tag`, `id_cookery`),
  INDEX `id_cookery_idx` (`id_cookery` ASC),
  CONSTRAINT `id_cookery`
    FOREIGN KEY (`id_cookery`)
    REFERENCES `cookery` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_tag`
    FOREIGN KEY (`id_tag`)
    REFERENCES `tags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);